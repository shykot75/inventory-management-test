window.routeToUrl = function(route, id) {
    let splitUrl = route.split('#id');
    return splitUrl[0]+id+splitUrl[1];
}
window.fetchRequest = async function (url, method='GET', requestBody=[]) {
    let options = {};
    if (method === 'GET'){
        options = {
            method: method,
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
            }
        }
    }else{
        options = {
            method: method,
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
            },
            body: method==='GET'? '':requestBody,
        }
    }
    const response = await fetch(url,options);
    if (!response.ok) {
        const message = `An error has occured: ${response.status}`;
        throw new Error(message);
    }
    return await response.json(); // Extracting data as a JSON Object from the response
}
