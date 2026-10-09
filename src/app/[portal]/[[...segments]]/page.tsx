import {notFound,redirect} from 'next/navigation';
import {adminPath,requireAdmin} from '@/lib/admin';
import {isConfigured} from '@/lib/supabase/server';
import {LoginForm,ScheduleForm,DeleteButton} from '@/components/admin-forms';
import {dateLabel,statusOf,type Schedule} from '@/lib/schedules';
import {logout} from '@/app/actions';
export const dynamic='force-dynamic';
export const metadata={title:'Admin — PT Sanwa Antar Nusa',robots:{index:false,follow:false}};
type Query=Record<string,string|string[]|undefined>;
export default async function Admin({params,searchParams}:{params:Promise<{portal:string;segments?:string[]}>;searchParams:Promise<Query>}) {
  const {portal,segments=[]}=await params;
  if('/'+portal!==adminPath) notFound();
  const route=segments.join('/');
  if(route==='login') return <main className="min-h-screen bg-[#06111F] grid place-items-center p-6"><div className="w-full max-w-md bg-white rounded-3xl p-8 shadow-xl"><a href="/"><img src="/images/logo%20sanwa.png" alt="Sanwa" className="h-16 mx-auto mb-8"/></a><h1 className="text-2xl font-bold mb-6">Login Admin</h1><LoginForm/><a href="/" className="block text-sm text-center mt-6">Kembali ke website</a></div></main>;
  if(!route) redirect(`${adminPath}/schedules`);
  if(route!=='schedules'&&route!=='schedules/create'&&!/^schedules\/\d+\/edit$/.test(route)) notFound();
  if(!isConfigured()) return <main className="max-w-xl mx-auto p-10"><h1 className="text-2xl font-bold">Pengaturan Supabase diperlukan</h1><p className="mt-4">Isi environment variables dan jalankan SQL di README untuk mengaktifkan panel admin.</p><a href="/" className="btn-accent mt-6">Kembali</a></main>;
  const db=await requireAdmin();
  let content:React.ReactNode;
  if(route==='schedules/create'||route.endsWith('/edit')) {
    let schedule:Schedule|undefined;
    if(route.endsWith('/edit')) {
      const {data,error}=await db.from('vessel_schedules').select('*').eq('id',Number(segments[1])).maybeSingle();
      if(error) throw Error('Jadwal gagal dimuat.');
      if(!data) notFound();
      schedule=data;
    }
    content=<div className="max-w-2xl mx-auto"><h1 className="text-3xl font-bold mb-8">{schedule?'Edit':'Tambah'} Jadwal Pelayaran</h1><div className="bg-white border rounded-3xl p-8"><ScheduleForm schedule={schedule} base={adminPath}/></div></div>;
  } else {
    const query=await searchParams;
    const value=(key:string)=> typeof query[key]==='string'?query[key] as string:'';
    let request=db.from('vessel_schedules').select('*').order('etd_sub',{ascending:false});
    const search=value('search').slice(0,150).replace(/[%_]/g,'');
    if(search) request=request.ilike('kapal',`%${search}%`);
    for(const [key,column,op] of [['closing_start','closing','gte'],['closing_end','closing','lte'],['etd_start','etd_sub','gte'],['etd_end','etd_sub','lte']] as const) {
      const date=value(key);
      if(/^\d{4}-\d{2}-\d{2}$/.test(date)&&Number.isFinite(Date.parse(date))) {
        const bound=column==='closing'?`${date}T${op==='gte'?'00:00:00':'23:59:59.999'}+07:00`:date;
        request=request[op](column,bound);
      }
    }
    if(value('status')==='full') request=request.eq('is_full',true);
    if(value('status')==='closed') request=request.eq('is_full',false).lt('closing',new Date().toISOString());
    if(value('status')==='available') request=request.eq('is_full',false).gte('closing',new Date().toISOString());
    const page=Math.max(1,Math.min(100000,Number.parseInt(value('page'),10)||1));
    const {data,error}=await request.range((page-1)*50,page*50);
    if(error) throw Error('Jadwal gagal dimuat. Periksa pengaturan database.');
    const schedules=(data||[]).slice(0,50) as Schedule[];
    const pageUrl=(n:number)=> {const qs=new URLSearchParams(); for(const key of ['search','closing_start','closing_end','etd_start','etd_end','status'])if(value(key))qs.set(key,value(key));qs.set('page',String(n));return `${adminPath}/schedules?${qs}`;};
    content=<><div className="flex flex-wrap justify-between gap-5 mb-8"><div><h1 className="text-3xl font-bold">Jadwal Kapal</h1><p className="mt-2 text-gray-500">Kelola jadwal pelayaran yang tampil di website.</p></div><a className="btn-accent" href={`${adminPath}/schedules/create`}>+ Tambah Jadwal</a></div>
      {value('success')==='saved'&&<p role="status" className="bg-green-50 text-green-700 p-4 rounded-xl mb-6">Jadwal berhasil disimpan.</p>}
      <form className="bg-white border p-6 rounded-2xl grid sm:grid-cols-3 gap-4 mb-8"><label>Cari kapal<input className="field" name="search" defaultValue={value('search')} placeholder="Nama kapal"/></label><label>Status<select className="field" name="status" defaultValue={value('status')}><option value="">Semua</option><option value="available">AVAILABLE</option><option value="full">FULL</option><option value="closed">CLOSED</option></select></label>{[['closing_start','Closing dari'],['closing_end','Closing sampai'],['etd_start','ETD dari'],['etd_end','ETD sampai']].map(([key,label])=><label key={key}>{label}<input type="date" className="field" name={key} defaultValue={value(key)}/></label>)}<div className="flex gap-4 items-center"><button className="btn-accent">Filter</button><a href={`${adminPath}/schedules`}>Reset</a></div></form>
      <div className="overflow-x-auto bg-white border rounded-2xl"><table className="w-full text-left text-sm"><thead className="bg-[#06111F] text-white"><tr>{['Kapal','Voyage','Closing (WIB)','ETD','Status','Aksi'].map(x=><th className="p-4 whitespace-nowrap" key={x}>{x}</th>)}</tr></thead><tbody>{schedules.map(s=><tr className="border-t" key={s.id}><td className="p-4 font-bold whitespace-nowrap">{s.kapal}</td><td className="p-4">{s.voy}</td><td className="p-4 whitespace-nowrap">{dateLabel(s.closing,true)}</td><td className="p-4 whitespace-nowrap">{dateLabel(s.etd_sub)}</td><td className="p-4">{statusOf(s)}</td><td className="p-4 flex gap-4"><a className="underline" href={`${adminPath}/schedules/${s.id}/edit`}>Edit</a><DeleteButton id={s.id}/></td></tr>)}{!schedules.length&&<tr><td colSpan={6} className="p-10 text-center">Tidak ada jadwal ditemukan.</td></tr>}</tbody></table></div>
      <nav aria-label="Halaman jadwal" className="flex gap-6 mt-6">{page>1&&<a href={pageUrl(page-1)}>← Sebelumnya</a>}<span>Halaman {page}</span>{(data||[]).length>50&&<a href={pageUrl(page+1)}>Selanjutnya →</a>}</nav>
    </>;
  }
  return <div className="min-h-screen bg-[#F7F8FA]"><header className="bg-[#06111F] text-white"><div className="max-w-7xl mx-auto px-6 py-5 flex flex-wrap justify-between gap-4"><a href={`${adminPath}/schedules`} className="font-bold">SANWA / Admin Panel</a><div className="flex gap-6"><a href="/">Lihat Website</a><form action={logout}><button>Keluar</button></form></div></div></header><main className="max-w-7xl mx-auto px-6 py-12">{content}</main></div>;
}
