import landing from '@/content/landing.json';
import LandingEffects from '@/components/landing-effects';
import PublicSchedules from '@/components/public-schedules';
import { isConfigured, supabaseServer } from '@/lib/supabase/server';
import { monthRange, type Schedule } from '@/lib/schedules';
export const dynamic = 'force-dynamic';
export default async function Home() {
  let schedules:Schedule[]=[];
  let error:string|undefined;
  if (isConfigured()) {
    try {
      const db=await supabaseServer();
      const {start,end}=monthRange();
      const result=await db.from('vessel_schedules').select('*').gte('etd_sub',start).lte('etd_sub',end).order('etd_sub');
      if(result.error) throw result.error;
      schedules=result.data || [];
    } catch {error='Jadwal sementara tidak tersedia. Silakan hubungi tim kami.';}
  } else error='Jadwal sementara tidak tersedia. Silakan hubungi tim kami.';
  // Trusted repository content only. No visitor input is inserted into this markup.
  return <><div dangerouslySetInnerHTML={{__html:landing.before}} /><PublicSchedules schedules={schedules} error={error}/><div dangerouslySetInnerHTML={{__html:landing.after.replace(/&copy; \d{4}/,`&copy; ${new Date().getFullYear()}`)}}/><LandingEffects/></>;
}
