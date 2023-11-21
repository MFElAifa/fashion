import React from "react";
import "./SearchBarCss.css";


class SearchBar extends React.Component {

    handleChange = (e) => {
        const { onRefresh} = this.props;
        e.preventDefault();
        const searchInput = e.target.value;
        
        onRefresh(searchInput);
    }
      
   render(){
    return (
        <div className="form-group has-search">
            <span className="fa fa-search form-control-feedback"></span>
            <input type="text" className="form-control" placeholder="Search" onChange={this.handleChange} value={this.props.searchWord}/>
        </div>
    );
   } 
};

export default SearchBar;