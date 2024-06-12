<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cookie Management</title>
    <script>
        // Create a cookie
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                let date = new Date();
                date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        // Read a cookie
        function getCookie(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(";");
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === " ") c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0)
                    return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        // Delete a cookie
        function eraseCookie(name) {
            document.cookie = name + "=; Max-Age=-99999999;";
        }

        // Example usage
        function manageCookies() {
            // Set cookie
            setCookie("username", "Johannes Belay", 7);
            // Read cookie
            alert("Cookie value: " + getCookie("username"));
            // Delete cookie
            eraseCookie("username");
        }
    </script>
</head>

<body>
    <button onclick="manageCookies()">Manage Cookies</button>
</body>

</html>