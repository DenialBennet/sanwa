import {defineConfig} from '@playwright/test';
import {existsSync} from 'node:fs';
const chrome=process.env.CHROME_PATH || 'C:/Program Files/Google/Chrome/Application/chrome.exe';
export default defineConfig({
  testDir:'./tests-e2e',
  use:{baseURL:'http://127.0.0.1:3100', browserName:'chromium', launchOptions:existsSync(chrome) ? {executablePath:chrome} : {}},
  webServer:{command:'npm run start -- -p 3100',url:'http://127.0.0.1:3100',timeout:60000,reuseExistingServer:false},
  reporter:'list'
});
