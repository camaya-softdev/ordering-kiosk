import React from "react";
import ReactDOM from "react-dom/client";
import App from "./App.jsx";
import { Provider } from 'react-redux';
import store from './store';
import { QueryClient, QueryClientProvider } from 'react-query';
const queryClient = new QueryClient();

ReactDOM.createRoot(document.getElementById("root")).render(
  <React.StrictMode>
    <QueryClientProvider client={queryClient}> 
      <Provider store={store}>
        <App />
      </Provider>
    </QueryClientProvider>
  </React.StrictMode>
);
