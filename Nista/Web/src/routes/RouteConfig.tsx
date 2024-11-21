import LoginPage from "../pages/auth/LoginPage";
import NotFoundPage from "../pages/auth/NotFound";
import UserPage from "../pages/auth/UserPage/inex";
import Dashboard from "../pages/screens/Dashboard";

export const publicRoutes = [
  { path: "/", element: <LoginPage /> },
  { path: "*", element: <NotFoundPage /> },
];

export const privateRoutes = [
  { path: "/dashboard", element: <Dashboard /> },
  { path: "/users", element: <UserPage /> },
  { path: "*", element: <NotFoundPage /> },
];
