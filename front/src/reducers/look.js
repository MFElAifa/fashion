import { 
    LOOK_REQUEST, 
    LOOK_ERROR, 
    LOOK_RECEIVED, 
    LOOK_UNLOAD
} from "../actions/constants";

export default(state = {
    post: null,
    isFetching: false
}, action) => {
    switch(action.type){
        case LOOK_REQUEST:
            return {
                ...state,
                isFetching: true,
            };
        case LOOK_RECEIVED:
            return {
                ...state,
                post: action.data,
                isFetching: false
            };
        case LOOK_ERROR:
            return {
                ...state,
                isFetching: false,
                post: null
            };
        case LOOK_UNLOAD:
            return {
                ...state,
                isFetching: false,
                post: null
            };
        default:
            return state;
    };
};