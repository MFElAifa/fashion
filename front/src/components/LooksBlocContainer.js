import React from 'react';
import LooksListContainer from './LooksListContainer';
import {looksListFetch} from '../actions/actions';
import {connect} from 'react-redux';
import SearchBar from './SearchBar';

const mapStateToPropos = state => ({
    userData: state.auth.userData,
    ...state.looksList
});

const mapDispatchToPropos = {
    looksListFetch
};

class LooksBlocContainer extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            searchWord: ''
        };
    }
    handleRefresh = (searchWord) => {
        const prevSearchWord = this.state.searchWord;
        this.setState({
            searchWord: searchWord
        });

        if (searchWord.length > 2) {
            this.props.looksListFetch(1, searchWord);
        } else if(searchWord.length !== prevSearchWord.length) {
            this.props.looksListFetch();
        }
    };

    render() {
        return (
            <div>
                <SearchBar onRefresh={this.handleRefresh} searchWord={this.state.searchWord}  />
                <LooksListContainer {...this.props} searchWord={this.state.searchWord} />
            </div>
        );
    }
}

export default connect(mapStateToPropos, mapDispatchToPropos)(LooksBlocContainer);
