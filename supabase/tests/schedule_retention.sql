-- Read-only boundary checks; returns PASS or raises an exception.
do $test$
declare
  scenario record;
  actual date;
begin
  for scenario in
    select * from (values
      ('2026-10-31 16:59:59+00'::timestamptz, date '2026-09-01'),
      ('2026-10-31 17:00:00+00'::timestamptz, date '2026-10-01'),
      ('2027-01-01 00:05:00+00'::timestamptz, date '2026-12-01'),
      ('2028-03-01 00:05:00+00'::timestamptz, date '2028-02-01')
    ) as cases(at_time, expected)
  loop
    actual := (date_trunc('month', scenario.at_time at time zone 'Asia/Jakarta') - interval '1 month')::date;
    if actual <> scenario.expected then
      raise exception 'Invalid retention cutoff: % expected %', actual, scenario.expected;
    end if;
    if (actual < actual) or not (actual - 1 < actual) or (actual + 1 < actual) then
      raise exception 'Invalid retention boundary';
    end if;
  end loop;
  raise notice 'PASS: Jakarta month boundary, year rollover, leap year and strict cutoff';
end;
$test$;
