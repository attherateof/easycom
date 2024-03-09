export function useImageValidation() {
    const isBase64 = (content) => {
        const img = new Image();
        img.src = content;

        return img.complete && img.naturalWidth !== 0;
    };

    return {isBase64};
}
