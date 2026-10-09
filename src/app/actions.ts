'use server';
import { redirect } from 'next/navigation';
import { revalidatePath } from 'next/cache';
import { adminPath, requireAdmin } from '@/lib/admin';
import { isConfigured, supabaseServer } from '@/lib/supabase/server';
import { validateSchedule } from '@/lib/validation.mjs';
export type FormState = {error:string};
export async function login(_state:FormState, form:FormData):Promise<FormState> {
  if (!isConfigured()) return {error:'Supabase belum dikonfigurasi. Ikuti README untuk pengaturan awal.'};
  const email=String(form.get('email')||'').trim();
  const password=String(form.get('password')||'');
  if (!email || !password) return {error:'Email dan password wajib diisi.'};
  const db=await supabaseServer();
  const {data,error}=await db.auth.signInWithPassword({email,password});
  if(error || !data.user) return {error:'Email atau password salah, atau terlalu banyak percobaan. Coba lagi nanti.'};
  const admin=await db.from('admin_users').select('user_id').eq('user_id',data.user.id).maybeSingle();
  if(admin.error || !admin.data) {await db.auth.signOut();return {error:'Akun ini tidak memiliki akses admin.'};}
  redirect(`${adminPath}/schedules`);
}
export async function logout() {
  const db=await supabaseServer(); await db.auth.signOut(); redirect(`${adminPath}/login`);
}
export async function saveSchedule(id:number|null,_state:FormState,form:FormData):Promise<FormState> {
  const db=await requireAdmin();
  let payload;
  try {payload=validateSchedule(Object.fromEntries(form));}
  catch(e) {return {error:e instanceof Error?e.message:'Data tidak valid.'};}
  const result=id===null ? await db.from('vessel_schedules').insert(payload) : await db.from('vessel_schedules').update(payload).eq('id',id).select('id').single();
  if(result.error) return {error:'Jadwal gagal disimpan. Periksa koneksi atau coba lagi.'};
  revalidatePath('/'); revalidatePath(`${adminPath}/schedules`);
  redirect(`${adminPath}/schedules?success=saved`);
}
export async function deleteSchedule(id:number,_state:FormState):Promise<FormState> {
  const db=await requireAdmin();
  const {error}=await db.from('vessel_schedules').delete().eq('id',id).select('id').single();
  if(error) return {error:'Jadwal gagal dihapus. Silakan coba lagi.'};
  revalidatePath('/'); revalidatePath(`${adminPath}/schedules`);
  return {error:''};
}
