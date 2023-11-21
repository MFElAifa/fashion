import React from 'react';
import { Route, Switch } from 'react-router';
import LoginForm from './LoginForm';
import LooksBlocContainer from './LooksBlocContainer';
import LookContainer from './LookContainer';
import Header from './Header';
import { requests } from '../agent';
import {connect} from 'react-redux';
import { userProfileFetch,userSetId, userLogout } from '../actions/actions';
import {looksListFetch} from '../actions/actions';

const mapStateToProps = state => ({
    ...state.auth
});

const mapDispatchToProps = {
    userProfileFetch,
    userSetId,
    userLogout,
    looksListFetch 
};

class App extends React.Component{
    
    constructor(props){
        super(props);

        const token = window.localStorage.getItem('jwtToken');
        if(token){
            requests.setToken(token);
        }
    }


    
    componentDidMount(){
        const userId = window.localStorage.getItem('userId');
        const {userSetId} = this.props;
        if(userId){
            userSetId(userId);
        }
    }
    componentDidUpdate(prevProps){
        const {userId, userData, userProfileFetch} = this.props;
        if(prevProps.userId !== userId && userId !== null && userData === null){
            userProfileFetch(userId);
        }
    }
    
    render(){
        const {isAuthenticated, userData, userLogout} = this.props;
        return (
            <div>
                <Header isAuthenticated={isAuthenticated} userData={userData} logout={userLogout}  />
                
                <Switch>
                    <Route path={"/login"}  render={props => <LoginForm {...props} />}  />
                    <Route path={"/looks/:id"} render={props => <LookContainer {...props} />}  />
                    <Route path={"/:page?"} render={props => <LooksBlocContainer {...props}  />}  />
                </Switch>
            </div>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(App);