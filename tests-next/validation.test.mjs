import {test} from 'node:test';
import assert from 'node:assert/strict';
import {validateSchedule} from '../src/lib/validation.mjs';
const valid={kapal:' KM. CALYPSO ',voy:'VOY. 100',closing:'2026-10-10',etd_sub:'2026-10-11',is_full:'on'};
test('Converts WIB to UTC and preserves checkbox status',()=>{
  const actual=validateSchedule(valid);
  assert.equal(actual.closing,'2026-10-10T16:59:59.999Z');
  assert.equal(actual.kapal,'KM. CALYPSO');
  assert.equal(actual.is_full,true);
  assert.equal(validateSchedule({...valid,is_full:undefined}).is_full,false);
});
test('Rejects impossible dates and closing after departure',()=>{
  for(const change of [{kapal:''},{closing:'2026-02-30'},{etd_sub:'2026-02-30'},{closing:'2026-10-12'},{closing:'hello'},{voy:'x'.repeat(101)}]) assert.throws(()=>validateSchedule({...valid,...change}));
});

test('Closing on departure date is allowed',()=>{assert.doesNotThrow(()=>validateSchedule({...valid,etd_sub:'2026-10-10'}));});
