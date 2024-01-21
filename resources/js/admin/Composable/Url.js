export function useUrl() {
    const updateUrl = async (params) => {
        const url = new URL(location);
        for (const key in params) {
            if (key !== "data_only") {
                url.searchParams.set(key, params[key]);
            }
        }

        history.pushState(params, "", url);
    };

    const getParams = (url) => {
        var queryString = url
            ? url.split("?")[1]
            : window.location.search.slice(1);

        var obj = {};

        const urlParams = new URLSearchParams(queryString);
        const entries = urlParams.entries();
        for (const [key, value] of entries) {
            obj[key] = value;
        }
        return obj;
    };
    

    return { getParams, updateUrl };
}
