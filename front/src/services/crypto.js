import axiosClient from "@/axios";


export async function cryptoFetchAll() {
    const response = await axiosClient.get('/cryptoValues');
    return response.data;
}

export async function cryptoFetchOne(id) {
    const response = await axiosClient.get(`/cryptoValues/${id}`);
    return response.data;
}