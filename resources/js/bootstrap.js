import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// ===== PUSHER DI-NONAKTIFKAN =====
// Hapus import echo karena mengandung Pusher
// import './echo';

// Nonaktifkan Pusher
window.Pusher = function () {
    return {
        subscribe: function () {
            return { bind: function () {} };
        },
        unsubscribe: function () {},
        connection: { bind: function () {} },
    };
};

console.log("✅ Pusher disabled successfully!");
