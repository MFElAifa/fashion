import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
//import { applyMiddleware, createStore } from 'redux';
//import { createBrowserHistory } from 'history';
//import { ConnectedRouter } from 'react-router-redux';
import { ConnectedRouter  } from 'connected-react-router';
import { Route } from 'react-router';
import App from './components/App';
//import reducer from './reducer';
//import thunkMiddleware from 'redux-thunk';
import configureStore, { history } from './configureStore'


                       
//const store = createStore( reducer, applyMiddleware(thunkMiddleware));
//const history = createBrowserHistory();
const store = configureStore();

ReactDOM.render(
    <Provider store={store}>
        <ConnectedRouter history={history}>
            <Route path={"/"} render={props => <App {...props} />}  />
        </ConnectedRouter>
    </Provider>, 
    document.getElementById('root')
);


