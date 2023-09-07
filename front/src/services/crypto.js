import axiosClient from "@/axios";


export async function cryptoFetchAll() {
    const response = await axiosClient.get('/cryptoValues');
    return response.data;
}

export async function cryptoFetchOne(id) {
    const response = await axiosClient.get(`/cryptoValues/${id}`);
    return response.data;
}

export async function buyCrypto(id, quantity, price, solde) {
    const response = await axiosClient.post('/cryptoWallet', {
        id: id,
        quantity: quantity,
        price: price,
        solde: solde
    });
    return response;
}

export async function boughtCryptoFetchAll() {
    const response = await axiosClient.get(`/cryptoWallet`);
    return response.data;
}

export async function sellCrypto(crypto) {
    const response = await axiosClient.delete(`/cryptoWallet/${crypto.id}`);
    return response.data;
}