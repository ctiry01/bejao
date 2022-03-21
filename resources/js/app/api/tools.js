const SERVER = 'http://localhost:8000/api/'


export async function postApi(url, payload, tk) {

    const headers = {
        'Content-Type': 'application/json',
        'Authorization' : 'Bearer '+tk
    }

    const response = await fetch(
        `${SERVER}${url}`,
        {
            method: 'POST',
            mode: 'cors',
            headers,
            body: JSON.stringify(payload)
        })

    // eslint-disable-next-line no-throw-literal
    if(response.status === 404) throw 'Not found';

    if(response.status === 204) return true
    return response.json()
}

export async function getApi(url) {
    const headers = {
        'Content-Type': 'application/json',
    }

    const response = await fetch(`${SERVER}${url}`, {
        headers
    })

    if(response.status === 204) return true

    return response.json()
}
