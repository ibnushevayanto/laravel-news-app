async function logout(link) {
    await event.preventDefault();
    await document.getElementById("logout-proccess").submit();
}
