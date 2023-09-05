import axiosClient from "@/axios";


export async function usersFetchAll() {
    const response = await axiosClient.get('/users');
    return response.data;
}

export async function usersFetchOne(id) {
    const response = await axiosClient.get(`/users/${id}`);
    return response.data;
}


export async function userCreate(name, password, role) {
    const response = await axiosClient.post('/users', {
        username: name,
        password: password,
        role: role
    });
    return response.data
}

export async function userUpdate(id, username, role) {
    const response = await axiosClient.put(`/users/${id}`, {
        username: username,
        role: role
    });
    return response.data
}

export async function userRemove(user) {
    const response = await axiosClient.delete(`/users/${user.id}`);
    return response.data
}