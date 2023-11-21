import {requests} from '../agent';
import {
    LOOKS_LIST_REQUEST, 
    LOOKS_LIST_ERROR, 
    LOOKS_LIST_RECEIVED,
    LOOKS_LIST_SET_PAGE,

    LOOK_REQUEST, 
    LOOK_ERROR, 
    LOOK_RECEIVED,
    LOOK_UNLOAD,

    USER_LOGIN_SUCCESS,
    USER_PROFILE_REQUEST,
    USER_PROFILE_ERROR,
    USER_PROFILE_RECEIVED,
    USER_SET_ID,
    USER_LOGOUT
} from './constants';
import { SubmissionError, reset } from 'redux-form';

// Look
export const lookRequest  = () => {
    return {
        type: LOOK_REQUEST
    }
};

export const lookError  = (error) => {
    return {
        type: LOOK_ERROR,
        error
    }
};

export const lookReceived  = (data) => {
    return {
        type: LOOK_RECEIVED,
        data
    }
};

export const lookUnload  = () => {
    return {
        type: LOOK_UNLOAD
    }
};


export const lookFetch  = (id) => {
    return (dispatch) => {
        dispatch(lookRequest());
        return requests.get(`/looks/${id}`)
            .then(response => dispatch(lookReceived(response)))
            .catch(error => dispatch(lookError(error)));
    }
};



// LooksList
export const looksListRequest  = () => {
    return {
        type: LOOKS_LIST_REQUEST
    }
};

export const looksListError  = (error) => {
    return {
        type: LOOKS_LIST_ERROR,
        error
    }
};

export const looksListReceived  = (data) => {
    return {
        type: LOOKS_LIST_RECEIVED,
        data 
    }
};

export const looksListSetPage  = (page) => {
    return {
        type: LOOKS_LIST_SET_PAGE,
        page
    }
};

export const looksListFetch  = (page = 1,search = '') => {
    let url = `/looks?page=${page}`;
    if(search.length >= 3 ){
        url += `&tags=${search}`;
    }
    return (dispatch) => {
        dispatch(looksListRequest());
        return requests.get(url)
            .then(response => dispatch(looksListReceived(response)))
            .catch(error =>dispatch(looksListError(error)));
    }
};



// LoginForm
export const userLoginSuccess = (token, userId) => {
    return {
        type: USER_LOGIN_SUCCESS,
        token, 
        userId
    }
};
export const userLoginAttempt = (username, password) => {
    return (dispatch) => new Promise((resolve, reject) => {
        requests.post('/login_check', {username, password}, false).then(
            response => dispatch(userLoginSuccess(response.token, response.id))
        ).catch(() => {
            reject(new SubmissionError({
                _error: 'Username or password is invalid'
            }))
        });
    })
};

export const userLogout = () => {
    return {
        type: USER_LOGOUT
    }
};



// User profie
export const userSetId  = (userId) => {
    return {
        type: USER_SET_ID,
        userId: userId
    }
};

export const userProfileRequest  = () => {
    return {
        type: USER_PROFILE_REQUEST
    }
};

export const userProfileError  = (userId) => {
    return {
        type: USER_PROFILE_ERROR,
        userId
    }
};

export const userProfileReceived  = (userId, userData) => {
    return {
        type: USER_PROFILE_RECEIVED,
        userData,
        userId
    }
};

export const userProfileFetch = (userId) => {
    return (dispatch) => {
        dispatch(userProfileRequest());
        return requests.get(`/users/${userId}`, true)
            .then(response => dispatch(userProfileReceived(userId, response)))
            .catch(() => dispatch(userProfileError(userId)));
    }
};
