export function truncateText(content, wordLimit = 5) {
    if (!content) return ''; 
  
    const words = content.split(' ');
  
    if (words.length > wordLimit) {
      return words.slice(0, wordLimit).join(' ') + '...';
    }
  
    return content;
  }
  