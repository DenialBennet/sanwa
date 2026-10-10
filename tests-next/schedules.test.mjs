import {test} from 'node:test';
import assert from 'node:assert/strict';
import {monthRange,statusOf,dateLabel} from '../src/lib/schedules.ts';
test('Public period respects Jakarta midnight and year boundary',()=>{
  assert.deepEqual(monthRange(new Date('2026-12-31T17:00:00Z')),{start:'2026-12-01',end:'2027-01-31'});
  assert.deepEqual(monthRange(new Date('2026-12-31T16:59:59Z')),{start:'2026-11-01',end:'2026-12-31'});
});
test('Full takes precedence, closing stays open through its Jakarta date, date uses WIB',()=>{
  const closing='2026-10-10T11:00:00Z';
  assert.equal(statusOf({closing,is_full:true},Date.parse('2026-10-11')),'FULL');
  assert.equal(statusOf({closing,is_full:false},Date.parse('2026-10-10T10:59:59Z')),'AVAILABLE');
  assert.equal(statusOf({closing,is_full:false},Date.parse('2026-10-10T11:00:01Z')),'AVAILABLE');
  assert.match(dateLabel('2026-10-09T18:00:00Z'),/10/);
});

test('Existing closing switches at Jakarta midnight',()=>{const s={closing:'2026-10-10T11:00:00Z',is_full:false};assert.equal(statusOf(s,Date.parse('2026-10-10T16:59:59.999Z')),'AVAILABLE');assert.equal(statusOf(s,Date.parse('2026-10-10T17:00:00Z')),'CLOSED');});
