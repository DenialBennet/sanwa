import {test} from 'node:test';
import assert from 'node:assert/strict';
import {validateSchedule} from '../src/lib/validation.mjs';
const valid={kapal:' KM. CALYPSO ',voy:'VOY. 100',closing:'2026-10-10T18:00',etd_sub:'2026-10-11',is_full:'on'};
test('Converts WIB to UTC and preserves checkbox status',()=>{
  const actual=validateSchedule(valid);
  assert.equal(actual.closing,'2026-10-10T11:00:00.000Z');
  assert.equal(actual.kapal,'KM. CALYPSO');
  assert.equal(actual.is_full,true);
  assert.equal(validateSchedule({...valid,is_full:undefined}).is_full,false);
});
test('Rejects impossible dates and closing after departure',()=>{
  for(const change of [{kapal:''},{closing:'2026-02-30T12:00'},{etd_sub:'2026-02-30'},{closing:'2026-10-12T12:00'},{closing:'hello'},{voy:'x'.repeat(101)}]) assert.throws(()=>validateSchedule({...valid,...change}));
});
