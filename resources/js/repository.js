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
                if (error.code === 'ERR_BAD_REQUEST') {
                    alert('Please fill in all values correctly.');
                }
                return false;
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
