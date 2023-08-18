import axiosClient from "@/axios";


export async function usersFetchAll() {
    const response = await axiosClient.get('/users');
    return response.data;
}




export async function userRemove(user) {
    const response = await axiosClient.delete(`/users/${user.id}`);
    return response.data
}