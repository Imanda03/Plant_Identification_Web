import { useMutation } from "react-query";
import axios from "axios";

const token = localStorage.getItem("authToken");
export const useLogin = () => {
  return useMutation(async (loginData: { email: string; password: string }) => {
    const response = await axios.post(
      "http://localhost:9000/api/auth/login",
      loginData
    );
    return response.data;
  });
};

export const getAllHistory = async () => {
  const response = await axios.get(
    `http://192.168.1.104:9000/api/auth/allHistory`
  );
  return response.data;
};
