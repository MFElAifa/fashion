export const parseApiErrors = (error) => {
    return error.response.body.violations.reduce(
        (parsedErrors,violation) => {
            parsedErrors[violation['propertyPath']] = violation['message'];
            return parsedErrors;
        },
        {}
    );
};

export const hydraPageCount = (collection) => {
    if(!collection['hydra:view']){
        return 1;
    }
    return Number(
        (collection['hydra:view']['hydra:last'])?collection['hydra:view']['hydra:last'].match(/page=(\d+)/)[1]:1
    );
};



export const canWriteLookBrand = (userData, brand) => {
    if(userData === null || brand === null) return false;
    let brands = userData !== null ? userData.brands:[];
    let brandsIds = brands.map(brd => {
        return brd.id;
    });
    return brandsIds.includes(brand.id);
};