import { useState } from "react";

const dashboardUrl = "/legacy-dashboard.html";

export default function App() {
  const [status, setStatus] = useState("loading");

  return (
    <main className="dashboard-host">
      <iframe
        className="dashboard-frame"
        title="Clearline Operations Dashboard"
        src={dashboardUrl}
        onLoad={() => setStatus("ready")}
        onError={() => setStatus("error")}
      />
      {status === "loading" && (
        <div className="dashboard-state" role="status">
          Loading Clearline workspace...
        </div>
      )}
      {status === "error" && (
        <div className="dashboard-state dashboard-error" role="alert">
          The dashboard could not be loaded. Confirm the Vite server is running
          and reload the page.
        </div>
      )}
    </main>
  );
}
