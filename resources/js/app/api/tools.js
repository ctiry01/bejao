const SERVER = 'http://localhost:8000/api/'

const token = localStorage.getItem('apikey')

export async function postApi(url, payload) {

    const headers = {
        'Content-Type': 'application/json',
    }

    if(token) headers.Authorization = token

    const response = await fetch(
        `${SERVER}${url}`,
        {
            method: 'POST',
            mode: 'cors',
            headers,
            body: JSON.stringify(payload)
        })

    console.log(response.status)
    // eslint-disable-next-line no-throw-literal
    if(response.status === 404) throw 'Not found';

    if(response.status === 204) return true
    return response.json()
}

export async function getApi(url) {
    const headers = {
        'Content-Type': 'application/json',
    }

    console.log(token)

    if(token) headers.Authorization = token

    const response = await fetch(`${SERVER}${url}`, {
        headers
    })

    if(response.status === 204) return true

    return response.json()
}
