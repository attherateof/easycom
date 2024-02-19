import axios from "axios";

export function useApi() {
  const fetchData = async (route, params = {}) => {
    try {
      const response = await axios.get(route, {
        headers: {
          "Data-Only": true,
        },
        params: params,
      });

      return response.data;
    } catch (error) {
      console.error(error);
      return null;
    }
  };

  const deleteData = async (route, ids, fake = false, status = true) => {
    if (fake) {
      return status;
    }

    try {
      const response = await axios.delete(route, {
        headers: {
          "Data-Only": true,
        },
        params: {
          ids: ids,
        },
      });

      return response.data.hasOwnProperty("success");
    } catch (error) {
      console.error(error);
      return false;
    }
  };

  return { fetchData, deleteData };
}
