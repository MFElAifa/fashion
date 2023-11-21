import React from 'react';
import LooksList from './LooksList';
import Paginator from './Paginator';
import {looksListFetch, looksListSetPage} from '../actions/actions';
import {connect} from 'react-redux';
import Spinner from './Spinner';


const mapStateToPropos = state => ({
    userData: state.auth.userData,
    ...state.looksList
});

const mapDispatchToPropos = {
    looksListFetch, looksListSetPage
};

class LooksListContainer extends React.Component{
    
    componentDidMount() {
        if(this.props.isFetching === false) {
            this.props.looksListFetch();
        }
    }
    
    componentDidUpdate(prevProps){
        const {currentPage, looksListFetch, looksListSetPage, searchWord} = this.props;
        
        if(prevProps.match.params.page !== this.getQueryParamPag()){
            looksListSetPage(this.getQueryParamPag());
        }

        if (prevProps.currentPage !== currentPage) {
            looksListFetch(currentPage, searchWord);
        }
    }

    getQueryParamPag(){
        return Number(this.props.match.params.page) || 1;
    }

    changePage(page){
        const {history, looksListSetPage} = this.props;
        looksListSetPage(page);
        history.push(`/${page}`);
    }

    onNextPageClick(e){
        const {currentPage, pageCount} = this.props;
        const newPage = Math.min(currentPage+1, pageCount);
        this.changePage(newPage);
    }

    onPrevPageClick(e){
        const {currentPage} = this.props;
        const newPage = Math.max(currentPage-1, 1);
        this.changePage(newPage);
    }
    render() {
        const {posts, userData, isFetching, currentPage, pageCount } = this.props;
        if(isFetching){
            return (<Spinner />);
        }
        return (
            <div>
                <LooksList posts={posts} userData={userData}/>
                <Paginator currentPage={currentPage} pageCount={pageCount} 
                    setPage={this.changePage.bind(this)} 
                    nextPage={this.onNextPageClick.bind(this)} 
                    prevPage={this.onPrevPageClick.bind(this)} />
            </div>
        );
    }
}

export default connect(mapStateToPropos, mapDispatchToPropos)(LooksListContainer);
