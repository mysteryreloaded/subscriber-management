class Repository {
    post(url, data) {
        return axios.post(url, data)
            .then(resp => {
                if (!resp.data) {
                    return null;
                }
                return resp.data;
            }).catch(error => {
                return false;
            });
    }

    postWithFullResponse(url, data) {
        return axios.post(url, data)
            .then(resp => {
                return resp;
            }).catch(error => {
                let errorResponse = JSON.parse(error.request.response);
                let errorMessageArray = Object.values(errorResponse.errors);
                let errorMessage = '';

                errorMessageArray.forEach(err => {
                    errorMessage += err[0] + '\n';
                });

                alert(errorMessage);
            });
    }

    get(url, data = {}) {
        return axios.get(url, {
            params: data
        }).then(resp => {
            return resp;
        }).catch(error => {
            return false;
        });
    }
}

export default new Repository();
