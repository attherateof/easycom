export function useSlug() {
    const generate = (data) => {
        let slug = (data.slug) ? data.slug : data.title;

        return slug.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-');
    };

    return {generate};
}
