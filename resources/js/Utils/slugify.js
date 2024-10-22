/**
 * Converts a string into a slug.
 * @param {string} text - The text to be converted into a slug.
 * @returns {string} - The slugified version of the text.
 */
export const slugify = (text) => {
    return text
        .toString()
        .toLowerCase()
        .replace(/\s+/g, '-')        // Replace spaces with -
        .replace(/[^\w\-]+/g, '')    // Remove all non-word chars
        .replace(/\-\-+/g, '-')      // Replace multiple - with single -
        .replace(/^-+/, '')          // Remove leading -
        .replace(/-+$/, '');         // Remove trailing -
};
