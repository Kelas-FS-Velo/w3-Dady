import { AxiosInstance } from "~/config";
import { jwtDecode } from "jwt-decode";

export const AuthAPI = {
  login: async (data) => {
    try {
      const response = await AxiosInstance.post("/login", data);
      if (response.data.status === "success") {
        const token = response.data.authorization.token;
        console.log(token);
        let role = "";
        let user = "";
        if (token) {
          const decoded = jwtDecode(token);
          role = decoded.role;
          user = decoded.username;
        }
        const userData = {
          token: response.data.authorization.token,
          role: role,
          username: user,
        };
        localStorage.setItem("token", userData.token);
        localStorage.setItem("role", userData.role);
        localStorage.setItem("username", userData.username);
      }
      return response.data;
    } catch (error) {
      console.error("Login error:", error);
      throw error;
    }
  },
  register: async (data) => {
    try {
      const response = await AxiosInstance.post("/register", {
        fullname: data.fullname,
        password: data.password,
        email: data.email,
        address: data.address,
        bod: data.bod,
        role: data.role || "user",
      });
      return response.data;
    } catch (error) {
      console.error("Register error:", error);
      throw error;
    }
  },
};
