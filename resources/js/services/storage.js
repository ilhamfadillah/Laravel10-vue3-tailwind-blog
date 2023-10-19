const API_TOKEN = "access_token";
const REFRESH_TOKEN = "refresh_token";

const tokenService = {
	getToken() {
		return localStorage.getItem(TOKEN_KEY);
	},

	saveToken(accessToken) {
		localStorage.setItem(TOKEN_KEY, accessToken);
	},

	getRefreshToken() {
		return localStorage.getItem(REFRESH_TOKEN_KEY);
	},

	saveRefreshToken(refreshToken) {
		localStorage.setItem(REFRESH_TOKEN_KEY, refreshToken);
	},
};
