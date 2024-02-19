// nestedArrayComposable.js
import { ref } from 'vue';

export function useNestedArray(flatArray) {
  const map = new Map();
  const result = ref([]);

  flatArray.forEach(item => {
    map.set(item.id, { ...item, children: [] });

    if (item.parent_id !== null) {
      const parent = map.get(item.parent_id);
      if (parent) {
        parent.children.push(map.get(item.id));
      } else {
        result.value.push(map.get(item.id));
      }
    } else {
      result.value.push(map.get(item.id));
    }
  });

  return result;
}
