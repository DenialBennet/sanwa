'use client';
import {useActionState} from 'react';
import {login,saveSchedule,deleteSchedule} from '@/app/actions';
import type {Schedule} from '@/lib/schedules';
const initial={error:''};
function Feedback({error}:{error:string}) {return error?<p role="alert" className="rounded-xl bg-red-50 text-red-700 p-4 text-sm">{error}</p>:null;}
export function LoginForm() {
  const [state,action,pending]=useActionState(login,initial);
  return <form action={action} className="space-y-5"><Feedback error={state.error}/><label className="block">Email<input className="field" type="email" name="email" required autoComplete="username"/></label><label className="block">Password<input className="field" type="password" name="password" required autoComplete="current-password"/></label><button disabled={pending} className="btn-accent w-full">{pending?'Memproses…':'Masuk'}</button></form>;
}
function localClosing(value:string) {
  const dt=new Date(value);
  return new Date(+dt+7*60*60*1000).toISOString().slice(0,16);
}
export function ScheduleForm({schedule,base}:{schedule?:Schedule;base:string}) {
  const [state,action,pending]=useActionState(saveSchedule.bind(null,schedule?.id || null),initial);
  return <form action={action} className="space-y-6"><Feedback error={state.error}/>
    <label className="block">Nama kapal<input className="field" list="vessels" name="kapal" maxLength={150} defaultValue={schedule?.kapal} required/><datalist id="vessels">{['KM. KINTAMANI','KM. CALYPSO','KM. SAKURA 09','KM. PACIFIC 88'].map(v=><option key={v} value={v}/>)}</datalist></label>
    <label className="block">Nomor Voyage (VOY)<input className="field" name="voy" maxLength={100} defaultValue={schedule?.voy} required placeholder="VOY. 2607"/></label>
    <div className="grid sm:grid-cols-2 gap-5"><label>Closing (WIB)<input className="field" type="datetime-local" name="closing" defaultValue={schedule?localClosing(schedule.closing):''} required/></label><label>ETD Surabaya<input className="field" type="date" name="etd_sub" defaultValue={schedule?.etd_sub} required/></label></div>
    <label className="flex gap-3 rounded-xl bg-gray-50 p-5"><input type="checkbox" name="is_full" defaultChecked={schedule?.is_full}/>Tandai kapal sudah penuh (FULL)</label>
    <div className="flex gap-4 items-center justify-end"><a href={`${base}/schedules`}>Batal</a><button className="btn-accent" disabled={pending}>{pending?'Menyimpan…':'Simpan Jadwal'}</button></div>
  </form>;
}
export function DeleteButton({id}:{id:number}) {
  const [state,action,pending]=useActionState(deleteSchedule.bind(null,id),initial);
  return <form action={action} onSubmit={e=>{if(!confirm('Hapus jadwal kapal ini?'))e.preventDefault();}}><button disabled={pending} className="text-red-600 underline">{pending?'Menghapus…':'Hapus'}</button><Feedback error={state.error}/></form>;
}
