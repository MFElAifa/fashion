import React from 'react';
import Look from './Look';
import {lookFetch, lookUnload} from '../actions/actions';
import {connect} from 'react-redux';
import Spinner from "./Spinner";

const mapStateToProps = state => ({
    userData: state.auth.userData,
    ...state.look
});

const mapDispatchToProps = {
    lookFetch,
    lookUnload
};

class LookContainer extends React.Component {
    componentDidMount(){
        if(this.props.isFetching === false){
            this.props.lookFetch(this.props.match.params.id);
        }
    }

    componentWillUnmount(){
        this.props.lookUnload();
    }

    render(){
        const {isFetching, post} = this.props;
        
        if(isFetching){
            return (<Spinner />);
        }
        return (
            <div>
                <Look post={post} userData={this.props.userData} />
            </div>
        )
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(LookContainer);