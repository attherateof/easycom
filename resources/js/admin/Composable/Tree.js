export function useTree() {
    const generateTree = (flatArray) => {
        const map = new Map();
        const result = [];

        flatArray.forEach(item => {
            map.set(item.id, {...item, children: []});

            if (item.parent_id !== null) {
                const parent = map.get(item.parent_id);
                if (parent) {
                    parent.children.push(map.get(item.id));
                } else {
                    result.push(map.get(item.id));
                }
            } else {
                result.push(map.get(item.id));
            }
        });

        return result;
    };

    const makeFlat = (data, parentId = 0) => {
        let flatArray = [];

        data.forEach(item => {
            const newItem = { ...item, parent_id: parentId };
            flatArray.push(newItem);

            if (item.children && item.children.length > 0) {
                flatArray = flatArray.concat(makeFlat(item.children, item.id));
            }
        });

        return flatArray;
    };

    return {generateTree, makeFlat};
}
