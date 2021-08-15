export function convertToDate(string) {
    var date = new Date(string);
    var res = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()
    return res
}