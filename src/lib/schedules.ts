export type Schedule = {
  id: number; kapal: string; voy: string; closing: string; etd_sub: string; is_full: boolean; updated_at: string;
};
export function statusOf(schedule: Pick<Schedule,'is_full'|'closing'>, now = Date.now()) {
  return schedule.is_full ? 'FULL' : new Date(schedule.closing).getTime() < now ? 'CLOSED' : 'AVAILABLE';
}
export function dateLabel(value: string, withTime = false) {
  return new Intl.DateTimeFormat('id-ID', { timeZone:'Asia/Jakarta', day:'2-digit',month:'short',year:'numeric', ...(withTime ? {hour:'2-digit',minute:'2-digit'} as const : {}) }).format(new Date(value.length === 10 ? value+'T00:00:00+07:00' : value));
}
export function monthRange(now = new Date()) {
  const parts = new Intl.DateTimeFormat('en-CA',{timeZone:'Asia/Jakarta',year:'numeric',month:'2-digit'}).formatToParts(now);
  const year=Number(parts.find(p=>p.type==='year')!.value);
  const month=Number(parts.find(p=>p.type==='month')!.value);
  const start = new Date(Date.UTC(year,month-2,1)).toISOString().slice(0,10);
  const end = new Date(Date.UTC(year,month,0)).toISOString().slice(0,10);
  return {start,end};
}
