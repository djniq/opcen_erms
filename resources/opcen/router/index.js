import { createWebHistory, createRouter } from "vue-router";

import Home from "@/views/Home.vue";
import Login from "@/views/Login.vue";
import Emt from "@/views/Emt.vue";
import Reports from "@/views/Reports.vue";
import ActiveDispatch from "@/views/EmtViews/ActiveDispatch.vue";
import DispatchHistory from "@/views/EmtViews/DispatchHistory.vue";
import Administrator from "@/views/Administrator.vue";
import AdminOverview from "@/views/AdminViews/Overview.vue";
import Ambulances from "@/views/AdminViews/Ambulances.vue";
import Drivers from "@/views/AdminViews/Drivers.vue";
import HealthFacilities from "@/views/AdminViews/HealthFacilities.vue";
import Responders from "@/views/AdminViews/Responders.vue";
import Users from "@/views/AdminViews/Users.vue";

const routes = [
  {
    path: "/",
    name: "Opcen",
    component: Home,
  },
  {
    path: "/emt",
    name: "EmtBase",
    component: Emt,
    children: [
      {
        path: "",
        name: "Active Dispatch",
        component: ActiveDispatch
      },
      {
        path: "/emt/dispatch-history",
        name: "Dispatch History",
        component: DispatchHistory
      }
    ]
  },
  {
    path: "/admin",
    name: "AdminBase",
    component: Administrator,
    children: [
      {
        path: "",
        name: "AdminOverview",
        component: AdminOverview
      },
      {
        path: "/admin/ambulances",
        name: "Ambulances",
        component: Ambulances
      },
      {
        path: "/admin/drivers",
        name: "Drivers",
        component: Drivers
      },
      {
        path: "/admin/health-facilities",
        name: "HealthFacilities",
        component: HealthFacilities
      },
      {
        path: "/admin/responders",
        name: "Responders",
        component: Responders
      },
      {
        path: "/admin/Users",
        name: "Users",
        component: Users
      }
    ]
  },
  {
    path: "/reports",
    name: "Reports",
    component: Reports,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;