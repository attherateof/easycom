export function useImageValidation() {
    const isBase64 = (content) => {
        let valid = false;
        let url = isUrl(content);
        if (!url) {
            valid = isImage(content)
        }
        return valid;
    };

    const isUrl = (str) => {
        var urlPattern = /^(?:\w+:)?\/\/([^\s.]+\.\S{2}|localhost[\:?\d]*)\S*$/;
        return urlPattern.test(str);
    };

    const isImage = (str) => {
        const img = new Image();
        img.src = str;

        return img.complete && img.naturalWidth !== 0;
    };

    return {isBase64, isImage};
}
