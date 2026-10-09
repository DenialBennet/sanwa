import 'server-only';
import { redirect } from 'next/navigation';
import { supabaseServer } from './supabase/server';

export const adminPath = '/' + (process.env.ADMIN_PATH || 'sanwa-internal-portal').replace(/^\/+|\/+$/g, '');
export async function requireAdmin() {
  const db = await supabaseServer();
  const { data: { user } } = await db.auth.getUser();
  if (!user) redirect(`${adminPath}/login`);
  const { data, error } = await db.from('admin_users').select('user_id').eq('user_id',user.id).maybeSingle();
  if (error || !data) redirect(`${adminPath}/login?error=forbidden`);
  return db;
}
