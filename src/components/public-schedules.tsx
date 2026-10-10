import { dateLabel, statusOf, type Schedule } from '@/lib/schedules';
export default function PublicSchedules({schedules,error}: {schedules:Schedule[];error?:string}) {
  return <section id="jadwal" className="py-20 bg-[#F7F8FA] scroll-mt-28"><div className="max-w-7xl mx-auto px-6 lg:px-8">
    <span className="section-eyebrow">Jadwal Pelayaran</span><h2 className="text-3xl sm:text-4xl font-extrabold mt-5 mb-4">Jadwal Kapal Surabaya – Kupang</h2>
    <p className="text-gray-500 mb-8">Jadwal bulan berjalan ditampilkan lebih dahulu, lalu bulan sebelumnya. Setiap bulan diurutkan dari keberangkatan paling awal. Jadwal dapat berubah mengikuti kondisi operasional.</p>
    <div className="overflow-x-auto rounded-2xl border bg-white"><table className="w-full text-sm text-left"><thead className="bg-[#06111F] text-white"><tr>{['Kapal','Voyage','Closing (WIB)','ETD Surabaya'].map(label=><th key={label} className="p-5 whitespace-nowrap">{label}</th>)}</tr></thead>
      <tbody>{schedules.map(s=><tr key={s.id} className="border-t"><td className="p-5 font-bold whitespace-nowrap">{s.kapal}</td><td className="p-5">{s.voy}</td><td className="p-5 whitespace-nowrap">{statusOf(s)==='AVAILABLE' ? dateLabel(s.closing) : <span className="font-bold text-red-600">{statusOf(s)}</span>}</td><td className="p-5 whitespace-nowrap">{dateLabel(s.etd_sub)}</td></tr>)}{!schedules.length&&<tr><td colSpan={4} className="p-10 text-center text-gray-500">{error || 'Belum ada jadwal kapal untuk periode ini.'}</td></tr>}</tbody>
    </table></div>{schedules.length>0&&<p className="mt-4 text-xs text-gray-400">Diperbarui: {dateLabel(schedules.reduce((latest,s)=>s.updated_at>latest?s.updated_at:latest,schedules[0].updated_at),true)}</p>}
  </div></section>;
}
