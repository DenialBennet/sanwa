begin;

create extension if not exists pg_cron with schema pg_catalog;

-- Supabase cron runs in UTC. 00:05 UTC on day 1 = 07:05 WIB.
-- Named scheduling is repeatable: running this migration again updates the job.
-- No immediate deletion; the first cleanup runs on the next day 1.
select cron.schedule(
  'sanwa-monthly-schedule-retention',
  '5 0 1 * *',
  $job$
    delete from public.vessel_schedules
    where etd_sub < (
      date_trunc('month', now() at time zone 'Asia/Jakarta')
      - interval '1 month'
    )::date;
  $job$
);

commit;
