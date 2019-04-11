import Cookies from 'js-cookie'

const TokenKey = 'xiaohongmao-Token'

export function getToken() {
  return Cookies.get(TokenKey)
}
export function getRole(){
  const jwt = JSON.parse(atob(getToken().match(/\.(.+)\./)[1]))
  return jwt
}

export function setToken(token) {
  return Cookies.set(TokenKey, token)
}

export function removeToken() {
  return Cookies.remove(TokenKey)
}
