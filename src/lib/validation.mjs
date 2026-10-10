export function validateSchedule(input) {
  const kapal=String(input.kapal || '').trim();
  const voy=String(input.voy || '').trim();
  const closing=String(input.closing || '');
  const etd_sub=String(input.etd_sub || '');
  if (!kapal || kapal.length>150 || !voy || voy.length>100) throw Error('Nama kapal dan voyage wajib diisi sesuai batas panjang.');
  if (!/^\d{4}-\d{2}-\d{2}$/.test(closing) || !/^\d{4}-\d{2}-\d{2}$/.test(etd_sub)) throw Error('Tanggal tidak valid.');
  const parsedClosing=new Date(closing+'T23:59:59.999+07:00');
  const parsedEtd=new Date(etd_sub+'T23:59:59.999+07:00');
  if (!Number.isFinite(+parsedClosing) || !Number.isFinite(+parsedEtd)) throw Error('Tanggal tidak valid.');
  // Date parsing normalizes invalid dates such as February 30; reject them explicitly.
  const validDate=(s)=> { const [y,m,d]=s.slice(0,10).split('-').map(Number); const dt=new Date(Date.UTC(y,m-1,d)); return dt.getUTCFullYear()===y&&dt.getUTCMonth()===m-1&&dt.getUTCDate()===d; };
  if (!validDate(closing) || !validDate(etd_sub)) throw Error('Tanggal tidak valid.');
  if (+parsedClosing>+parsedEtd) throw Error('Closing tidak boleh melewati tanggal keberangkatan.');
  return {kapal,voy,closing:parsedClosing.toISOString(),etd_sub,is_full:input.is_full===true||input.is_full==='on'};
}
