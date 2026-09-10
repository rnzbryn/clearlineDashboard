import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import { copyFileSync } from "node:fs";
import { resolve } from "node:path";

const phpFiles = [
  "db_connect.php",
  "get_staff.php",
  "add_staff.php",
  "update_staff_status.php",
  "delete_staff.php",
];

function copyPhpApi() {
  return {
    name: "copy-php-api",
    writeBundle({ dir }) {
      for (const file of phpFiles) {
        copyFileSync(resolve(import.meta.dirname, file), resolve(dir, file));
      }
    },
  };
}

export default defineConfig({
  plugins: [react(), copyPhpApi()],
});