import { 
    LOOKS_LIST_REQUEST, 
    LOOKS_LIST_ERROR, 
    LOOKS_LIST_RECEIVED, 
    LOOKS_LIST_SET_PAGE
} from "../actions/constants";
import { hydraPageCount } from "../apiUtils";

export default(state = {
    posts: null,
    isFetching: false,
    currentPage: 1,
    pageCount: null
}, action) => {
    switch(action.type){
        case LOOKS_LIST_REQUEST:
            return {
                ...state,
                isFetching: true,
            };
        case LOOKS_LIST_RECEIVED:
            return {
                ...state,
                posts: action.data['hydra:member'],
                pageCount: hydraPageCount(action.data),
                isFetching: false
            };
        case LOOKS_LIST_ERROR:
            return {
                ...state,
                isFetching: false,
                posts: null
            };
        case LOOKS_LIST_SET_PAGE:
            return {
                ...state,
                currentPage: action.page
            };
        default:
            return state;
    };
};