import axios from "axios";

export function useApi() {
    const fetchData = async (route, params) => {
        let data = null;
        await axios
            .get(route, {
                headers: {
                    "Data-Only": true,
                },
                params: params,
            })
            .then((res) => {
                data = res.data;
            })
            .catch((error) => {
                console.log(error);
            });

        return data;
    };

    const deleteData = async (route, ids, fake = false, status = true) => {
        let deleted = false;
        if (!fake) {
            await axios
                .delete(route, {
                    headers: {
                        "Data-Only": true,
                    },
                    params: {
                        ids: ids,
                    },
                })
                .then((res) => {
                    let data = res.data;
                    if (data.hasOwnProperty("success")) {
                        deleted = true;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        } else {
            deleted = status;
        }

        return deleted;
    };

    return { fetchData, deleteData };
}
