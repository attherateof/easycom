export function useImage() {
    const resize = (file, maxWidth = 500, maxHeight = 500) => {
        return new Promise((resolve) => {
            const reader = new FileReader();

            reader.onload = (e) => {
                const img = new Image();
                img.src = e.target.result;

                img.onload = () => {
                    const {width, height} = calculateNewDimensions(img.width, img.height, maxWidth, maxHeight);
                    const canvas = createCanvas(width, height);
                    const ctx = canvas.getContext('2d');

                    drawImageOnCanvas(img, ctx, width, height);

                    const resizedImage = getResizedImageData(canvas);
                    resolve(resizedImage);
                };
            };

            reader.readAsDataURL(file);
        });
    };

    const calculateNewDimensions = (originalWidth, originalHeight, maxWidth, maxHeight) => {
        let width = originalWidth;
        let height = originalHeight;

        if (width > maxWidth) {
            height *= maxWidth / width;
            width = maxWidth;
        }

        if (height > maxHeight) {
            width *= maxHeight / height;
            height = maxHeight;
        }

        return {width, height};
    };

    const createCanvas = (width, height) => {
        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;
        return canvas;
    };

    const drawImageOnCanvas = (img, ctx, width, height) => {
        ctx.drawImage(img, 0, 0, width, height);
    };

    const getResizedImageData = (canvas) => {
        return canvas.toDataURL('image/webp');
    };

    return {resize};
}
