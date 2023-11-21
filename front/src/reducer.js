import { combineReducers } from "redux";
import { connectRouter } from 'connected-react-router';
import looksList from "./reducers/looksList";
import look from "./reducers/look";
import {reducer as formReducer} from "redux-form";
import auth from "./reducers/auth";

const createRootReducer = (history) => combineReducers({
  looksList,
  look,
  auth,
  router: connectRouter(history),
  form: formReducer
})
export default createRootReducer